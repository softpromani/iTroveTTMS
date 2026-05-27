University ERP – Timetable Management System Requirements Document
1. System Overview

The Timetable Management System is a centralized academic scheduling platform for colleges/universities that automates:

Class scheduling
Faculty allocation
Room/lab allocation
CBCS elective mapping
Attendance integration
Student personalized schedules
Exam scheduling
Substitution management

The system integrates with:

Student Information System (SIS)
LMS
Attendance
Examination
HR/Faculty
Infrastructure Management
2. Main Modules
Module	Purpose
Academic Structure Management	Define courses, programs, semesters
Timetable Engine	Generate class schedules
Faculty Management	Manage teacher workload & availability
Classroom/Lab Management	Infrastructure allocation
CBCS & Elective Management	Flexible subject scheduling
Student Schedule Management	Personalized timetable
Attendance Integration	Attendance mapping
Substitution Management	Faculty replacement
Exam Timetable Management	Exam scheduling
Notifications & Alerts	Real-time communication
Reports & Analytics	Utilization and workload reports
Mobile/API Layer	Student & faculty access
3. Module Wise Requirements
MODULE 1 — Academic Structure Management
Purpose

Create academic hierarchy.

Features
Program Management
Create Program
UG/PG/PhD types
Program duration
Credit structure
Department Management
Department creation
Department HOD mapping
Course/Subject Management
Subject code
Credits
Lecture/Tutorial/Practical hours
Semester mapping
Semester Management
Academic year
Semester duration
Start/end dates
Section/Batch Management
Section A/B/C
Batch year
Student strength
Database Tables
programs
id
name
type
duration
status
departments
id
program_id
name
hod_id
subjects
id
department_id
subject_code
subject_name
credits
lecture_hours
tutorial_hours
practical_hours
MODULE 2 — Timetable Engine
Purpose

Automatically generate conflict-free schedules.

Features
Timetable Creation
Manual timetable
Auto timetable generation
Semester-wise schedule
Section-wise schedule
Time Slot Management
Slot duration
Break periods
Working days
Shift handling
Scheduling Rules
Max faculty hours/day
No overlapping
Room capacity validation
Lab requirements
Drag & Drop Timetable
Move classes visually
Instant conflict detection
Auto Optimization
Faculty preference priority
Gap minimization
Room optimization
Workflow
Create Academic Calendar
        ↓
Define Time Slots
        ↓
Assign Subjects
        ↓
Assign Faculty
        ↓
Assign Rooms/Labs
        ↓
Run Conflict Validation
        ↓
Generate Timetable
        ↓
Review & Approve
        ↓
Publish
Database Tables
timetable_slots
id
day
start_time
end_time
slot_type
timetable_entries
id
semester_id
section_id
subject_id
faculty_id
room_id
slot_id
date
status
MODULE 3 — Faculty Management
Features
Faculty Profile
Qualification
Department
Expertise
Availability
Workload Management
Max teaching hours
Weekly workload
Overtime tracking
Faculty Preferences
Preferred slots
Preferred days
Unavailable periods
Workflow
Create Faculty
      ↓
Assign Department
      ↓
Set Availability
      ↓
Assign Subjects
      ↓
Allocate Timetable
      ↓
Track Workload
MODULE 4 — Classroom & Lab Management
Features
Room Creation
Capacity
Smart room support
Building/floor mapping
Lab Management
Lab type
Computer count
Equipment inventory
Allocation Rules
Capacity validation
Lab-specific scheduling
Smart classroom allocation
Database
rooms
id
room_no
building
capacity
type
MODULE 5 — CBCS & Elective Management
Features
Elective Groups
Open elective
Professional elective
Minor specialization
Student Course Registration
Subject selection
Slot validation
Credit validation
Dynamic Timetable
Personalized schedule generation
Clash prevention
Workflow
Create Electives
       ↓
Open Registration
       ↓
Student Selects Subjects
       ↓
Validate Credits
       ↓
Validate Timetable Clash
       ↓
Generate Personalized Timetable
MODULE 6 — Student Timetable Module
Features
Student Dashboard
Daily schedule
Weekly timetable
Room details
Faculty details
Smart Features
Upcoming class reminders
Attendance indicator
LMS integration
Mobile Support
Android/iOS timetable
Push notifications
MODULE 7 — Attendance Integration
Features
Attendance Mapping
Auto map class slots
QR attendance
RFID integration
Face recognition support
Real-Time Attendance
Live attendance marking
Absence alerts
Workflow
Class Starts
      ↓
Attendance Open
      ↓
Student Verification
      ↓
Attendance Stored
      ↓
Attendance Analytics Updated
MODULE 8 — Substitution Management
Features
Substitute Faculty
Emergency replacement
Auto available faculty suggestions
Notifications
Notify replacement faculty
Notify students
Workflow
Faculty Absent
      ↓
Request Substitute
      ↓
Find Available Faculty
      ↓
Assign Replacement
      ↓
Update Timetable
      ↓
Notify Stakeholders
MODULE 9 — Examination Timetable
Features
Exam Scheduling
Mid-semester
End-semester
Practical exams
Hall Allocation
Capacity based
Department segregation
Conflict Prevention
No same-day overload
Faculty invigilation scheduling
MODULE 10 — Notification System
Features
Channels
SMS
Email
Push notification
WhatsApp API
Events
Timetable published
Class cancelled
Room changed
Faculty changed
MODULE 11 — Reports & Analytics
Reports
Faculty Reports
Workload report
Free hours
Utilization report
Infrastructure Reports
Room occupancy
Lab utilization
Student Reports
Attendance linked timetable
Schedule analytics
4. User Roles
Role	Permissions
Super Admin	Full access
Academic Admin	Manage scheduling
HOD	Approve department timetable
Faculty	View/update own schedule
Student	View personalized timetable
Exam Controller	Exam scheduling
Infrastructure Admin	Room/lab management
5. Approval Workflow
Timetable Draft
      ↓
Department Review
      ↓
HOD Approval
      ↓
Academic Office Approval
      ↓
Publish to Students & Faculty
6. APIs Required
Internal APIs
Timetable APIs
GET /api/timetable/student/{id}
GET /api/timetable/faculty/{id}
POST /api/timetable/generate
Attendance APIs
POST /api/attendance/mark
GET /api/attendance/report
7. Suggested Technology Stack
Backend
Laravel 11
MySQL/PostgreSQL
Redis Queue
Frontend
Vue 3 + Inertia
FullCalendar Scheduler
Real-Time
Laravel WebSockets
Pusher
AI Optimization
Python FastAPI microservice
OR-Tools timetable optimization
8. AI Auto Timetable Generation Logic
Constraints
Hard Constraints
No faculty overlap
No room overlap
Lab requirement validation
Capacity validation
Soft Constraints
Faculty preferences
Minimize idle periods
Consecutive lecture optimization
AI Workflow
Input Data
   ↓
Build Constraints
   ↓
Optimization Engine
   ↓
Generate Candidate Timetables
   ↓
Score Timetables
   ↓
Select Best Timetable
   ↓
Publish Draft
9. Recommended Laravel Architecture
Suggested Structure
Modules/
 ├── Academics/
 ├── Timetable/
 ├── Faculty/
 ├── Attendance/
 ├── Examination/
 ├── Infrastructure/
 ├── Notifications/
10. Suggested UI Screens
Admin Screens
Timetable dashboard
Drag-drop scheduler
Conflict viewer
Faculty workload heatmap
Faculty Screens
My schedule
Substitution requests
Attendance screen
Student Screens
My timetable
Upcoming classes
Attendance summary
11. Recommended Third-Party Integrations
Purpose	Tool
Calendar UI	FullCalendar Scheduler
Video Classes	Zoom/Google Meet
SMS	Twilio/Fast2SMS
WhatsApp	Meta API
Face Recognition	MediaPipe/OpenCV
Optimization	Google OR-Tools
12. Future Advanced Features
AI timetable prediction
Smart classroom IoT integration
Biometric attendance
Proctoring integration
Dynamic room switching
Voice assistant timetable queries
Predictive absenteeism analytics