# Student Records Overview

Student Records is a Laravel-based web application designed to manage academic information in a simple and organized way. The system allows users to add new students, update their course grades, generate performance reports, and visualize real-time statistics. It includes a dashboard where users can register students, view all students, assign grades per course, and review summarized analytics about student performance.

The purpose of creating this software was to practice Laravel fundamentals (specifically raw SQL query building and integration within Laravel controllers) while reinforcing concepts such as CRUD operations, joins, database structure, and aggregate reporting. This project also serves as a portfolio piece demonstrating backend logic built without ORM abstractions.

---

## 📽️ Software Demo Video

**YouTube Demo**  
*(A one-minute demo showing the software workflow, CRUD operations, grade assignment, and the real-time report updates.)*

---

## 🛠️ Development Environment

**Tools Used:**  
VS Code, PHP, Composer, Laravel, SQLite, Git/GitHub

**Programming Language:**  
PHP

**Framework:**  
Laravel

**Database:**  
SQLite (used to create and store the entire database, tables, and records)

### ✔️ Key Features Implemented

- Database built with **SQLite**, containing multiple tables (`students`, `courses`, `grades`).
- **All operations implemented using raw SQL**, not Eloquent ORM.
- Full CRUD using manually written SQL queries:
  - `INSERT`, `UPDATE`, `DELETE`, `SELECT`
- Joins between two or more tables using pure SQL.
- Aggregate SQL functions implemented directly, such as:
  - `AVG()` for average grade per student  
  - `AVG()` for overall course averages  

---

## 🎯 Features & Functionality

- **Add New Students** through a simple dashboard.  
- **View All Students**, each with a dropdown to select a course and assign a grade.  
- **Add Grades** to the selected student and course combination.  
- **Automatic Reports**, including:
  - Average grade of each student  
  - Overall grade average for each course  
- **Management Route:**  
  - `/student` — edit and remove student records  
- Dashboard updates automatically when new grades are submitted.

---

## 📡 Application Routes

### 🔷 Dashboard Routes
These routes handle the main view where students, courses, grades, and reports are displayed.

| Method | Route | Description |
|--------|--------|-------------|
| GET | `/dashboard` | Displays students, courses, grades, and performance reports. |
| POST | `/dashboard/students` | Creates a new student from the dashboard. |
| POST | `/dashboard/students/{student}/grades` | Adds a grade for a specific student. |

---

### 🔷 Student Management Routes
These routes handle CRUD operations for student records.

| Method | Route | Description |
|--------|--------|-------------|
| GET | `/students` | Lists all students. |
| POST | `/students` | Creates a new student. |
| GET | `/students/{id}/edit` | Shows edit form for a specific student. |
| PUT | `/students/{id}` | Updates the selected student's data. |
| DELETE | `/students/{id}` | Deletes a student. |

---

## 🌐 Useful Websites

| Website Name | Link |
|--------------|------|
| Laravel Documentation | https://laravel.com/docs |
| PHP Manual | https://www.php.net/manual/en/ |
| SQLite Documentation | https://www.sqlite.org/docs.html |
| W3Schools SQL Tutorial | https://www.w3schools.com/sql/ |
| SQL Reference (MDN) | https://developer.mozilla.org/en-US/docs/Web/SQL |

---

