# Freelancer Income & Expense Tracker (CLI)

A simple command-line application to track income, expenses, and savings for freelancers. Built using **Laravel Console Commands**.

## 🚀 Features

✅ **Add Income** - Track payments from clients and platforms like Upwork, Fiverr, etc.  
✅ **Add Expense** - Log expenses like software subscriptions, hosting, and tools.  
✅ **View Income & Expenses** - Easily list all financial transactions.  
✅ **Export Data** - Generate a CSV report of income and expenses.  
✅ **Category Management** - Organize income and expenses by category.  
✅ **Savings Calculation** - Track how much you're saving.  
✅ **User Registration via CLI** - Create users directly from the terminal.

---

## 📌 Installation & Setup

### **1 Clone the Repository**

```bash
git clone https://github.com/aarifhsn/fintrack-cli.git
cd fintrack-cli
```

### **2 Install Dependencies**

```bash
composer install
```

### **3 Set Up the Database**

Create a `.env` file and update the database credentials:

```bash
cp .env.example .env
```

Then, run:

```bash
php artisan migrate --seed
```

(Seeding will create a default admin user.)

### **4 Register a New User (Optional)**

Run the following command to manually register a user:

```bash
php artisan user:register
```

---

## 🎯 Usage

### **➤ Add Income**

```bash
php artisan fintrack:add-income
```

You will be prompted to enter details like amount, category, and description.

### **➤ Add Expense**

```bash
php artisan fintrack:add-expense
```

Log expenses like software subscriptions, office rent, etc.

### **➤ View All Incomes**

```bash
php artisan fintrack:view-incomes
```

### **➤ View All Expenses**

```bash
php artisan fintrack:view-expenses
```

### **➤ View Total Savings**

```bash
php artisan fintrack:view-savings
```

(Income - Expenses = Savings)

### **➤ Export fintrack Data as CSV**

```bash
php artisan fintrack:export --user=1
```

(Replace `1` with your user ID, or omit it to export all users.)

```

**(Change it immediately after setup!)**

---

## 🛠 Troubleshooting

🔹 **No users found?**
Run: `php artisan user:register` to create one.

🔹 **Database error?**
Check your `.env` file and ensure the database is set up properly.

🔹 **Need help?**
Run `php artisan list` to see all available commands.

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).
```
