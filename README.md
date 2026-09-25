# Elegance Salon — Web Management System

A full-stack, role-based web application designed to streamline daily operations, staff workflows, and customer appointments for modern beauty salons and spas[cite: 1]. Built with **Laravel**,and **MySQL**, the system unifies dynamic appointment scheduling, inventory tracking, client records, and automated staff commission tracking into a single, cohesive dashboard[cite: 1].

---

## Key Features

### 🔐 Role-Based Access Control (RBAC)
* **Admin Dashboard:** Full oversight of salon revenue, staff performance, services catalog, inventory levels, and system settings.
* **Receptionist Portal:** Efficiently manage walk-in/online bookings, assign available stylists, re-schedule appointments, and issue customer invoices[cite: 1].
* **Stylist View:** Personalized daily timetable,and completed client logs

### 📅 Smart Appointment & Client Management
* Real-time slot availability based on staff schedules and service durations[cite: 1].
* Centralized client database storing interaction history, preferred services, and visit records[cite: 1].


### 📦 Inventory & Stock Control
* Track salon usage products vs. retail products[cite: 1].
* Stock level monitoring to prevent shortages during peak hours[cite: 1].

---

## Tech Stack

* **Backend:** PHP 8.x, Laravel Framework (MVC Architecture, Eloquent ORM, Middleware Auth)[cite: 1]
* **Frontend:** Blade Templating Engine, HTML5, CSS3, JavaScript, Bootstrap 5[cite: 1]
* **Database:** MySQL (Relational Schema, Foreign Key Constraints, Indexes, Views)[cite: 1]
* **Tools & Version Control:** Git, GitHub, Composer[cite: 1]

---

## Database Architecture Overview

The relational database is normalized to handle complex multi-entity relationships cleanly:
* `users` & `roles` — Implements multi-guard authentication for Admins, Receptionists, and Stylists[cite: 1].
* `appointments` — Connects `clients`, `services`, and `staff` with precise time slot mapping[cite: 1].
* `inventory` — Tracks product usage per service and retail stock balances[cite: 1].

