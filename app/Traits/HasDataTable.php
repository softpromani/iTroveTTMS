<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait to add a reusable server‑side DataTable endpoint.
 *
 * Controllers using this trait should define a public method `datatable`
 * that simply forwards the request to {@see applyDataTable()} with the
 * appropriate query builder and column definition array.
 */
trait HasDataTable
{
    /**
     * Build a JSON response for a DataTable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query   Base query builder for the model.
     * @param  array  $columns  Array of column definitions. Each column may contain:
     *                         - key (string): attribute name on the model
     *                         - label (string): column header text
     *                         - searchable (bool)
     *                         - sortable (bool)
     *                         - filterable (bool) – optional per‑column filter
     *                         - render (callable) – optional value transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyDataTable(Request $request, Builder $query, array $columns)
    {
        // Pagination params
        $page    = max(1, (int) $request->input('page', 1));
        $perPage = (int) $request->input('per_page', 20);
        $perPage = $perPage > 0 ? $perPage : 20;

        // Sorting params
        $sortBy  = $request->input('sort_by');
        $sortDir = strtolower($request->input('sort_dir', 'asc')) === 'desc' ? 'desc' : 'asc';

        // Global search param
        $search = $request->input('search', '');

        // ----- Global search -------------------------------------------------
        if ($search !== '') {
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $col) {
                    if (!empty($col['searchable'])) {
                        $q->orWhere($col['key'], 'LIKE', "%{$search}%");
                    }
                }
            });
        }

        // ----- Column specific filters --------------------------------------
        foreach ($columns as $col) {
            if (!empty($col['filterable'])) {
                $filterKey = 'filter_' . $col['key'];
                if ($request->filled($filterKey)) {
                    $query->where($col['key'], $request->input($filterKey));
                }
            }
        }

        // ----- Sorting ------------------------------------------------------
        if ($sortBy && in_array($sortBy, array_column($columns, 'key'), true)) {
            $query->orderBy($sortBy, $sortDir);
        }

        // Use Laravel's paginator (cursor pagination can be swapped later)
        $paginator = $query->paginate($perPage, ['*'], 'page', $page);
        $items     = $paginator->items();

        // Apply optional render callbacks on each row
        foreach ($items as $item) {
            foreach ($columns as $col) {
                if (!empty($col['render']) && is_callable($col['render'])) {
                    $item->{$col['key']} = call_user_func($col['render'], $item);
                }
            }
        }

        return response()->json([
            'data'    => $items,
            'meta'    => [
                'total'        => $paginator->total(),
                'per_page'     => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'from'         => $paginator->firstItem(),
                'to'           => $paginator->lastItem(),
                'prev_page_url'=> $paginator->previousPageUrl(),
                'next_page_url'=> $paginator->nextPageUrl(),
            ],
            'columns' => $columns,
        ]);
    }
}
?>
