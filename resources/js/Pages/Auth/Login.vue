<template>
  <div class="login-box">
    <div class="login-logo">
      <b>Trove</b> TTMS
    </div>
    <div class="card card-outline card-primary">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form @submit.prevent="form.post('/login')">
          <div class="input-group mb-3" :class="{'has-error': form.errors.email}">
            <input v-model="form.email" type="email" class="form-control" placeholder="Email" required autofocus :class="{'is-invalid': form.errors.email}"/>
            <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email }}</div>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
          </div>
          <div class="input-group mb-3" :class="{'has-error': form.errors.password}">
            <input v-model="form.password" type="password" class="form-control" placeholder="Password" required :class="{'is-invalid': form.errors.password}"/>
            <div class="invalid-feedback" v-if="form.errors.password">{{ form.errors.password }}</div>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" v-model="form.remember" />
                <label for="remember">Remember Me</label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" :disabled="form.processing">Sign In</button>
            </div>
          </div>
        </form>
        <p class="mb-0 text-center" v-if="false"><!-- placeholder for future links --></p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const layout = AuthLayout;
</script>

<style scoped>
.login-box {
  width: 360px;
  margin: 7% auto;
}
</style>
