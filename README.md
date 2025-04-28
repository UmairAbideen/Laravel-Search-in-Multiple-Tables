# 🔍 Laravel Complex Search in Related Tables

This Laravel 10 project demonstrates a **dynamic multi-table search** where users belong to groups and have multiple cars. It allows filtering users by group or name and displays the cars they own — all within a clean Bootstrap-powered UI.

---

## 🚀 Features

- **User & Group Management**: Assign users to groups.
- **Car Management**: Link multiple cars to each user.
- **Smart Filtering**:
  - Filter users by group.
  - Search users by name.
  - Display associated cars.
- **Dynamic Dropdowns**: Filter users based on selected group.
- **AJAX-Powered UI**: Smooth and fast updates without full page reloads.
- **Responsive Design**: Built with Bootstrap 5.

---

## 🧠 Core Relationships

- `Group` → has many → `Users`
- `User` → belongs to → `Group`, has many → `Cars`
- `Car` → belongs to → `User`

---

## 🛠 Tech Stack

| Tool          | Purpose                        |
|---------------|--------------------------------|
| Laravel 10    | Backend framework              |
| Blade         | Templating engine              |
| Eloquent ORM  | Database relationships         |
| Bootstrap 5   | Frontend styling               |
| AJAX (jQuery) | Dynamic dropdown & search UX   |

---

## ▶️ How It Works

1. **Eloquent relationships** handle data linkage.
2. **AJAX dropdown** loads users based on selected group without page reload.
3. **Search form** filters users by name or group.
4. **Blade views** show users and their related cars in a table layout.
