# Freelancer Income & Expense Tracker (CLI)

A simple command-line application to track income, expenses, taxes, and savings for freelancers. Built using **Laravel Console Commands**.

## 🚀 Features

✅ **Add Income** - Track payments from clients and platforms like Upwork, Fiverr, etc.  
✅ **Add Expense** - Log expenses like software subscriptions, hosting, and tools.  
✅ **View Income & Expenses** - Easily list all financial transactions.  
✅ **Export Data** - Generate a CSV report of income and expenses.  
✅ **Category Management** - Organize income and expenses by category.  
✅ **Savings Calculation** - Track how much you're saving.  
✅ **Tax Calculation** - Automatically calculate taxes based on income and deductions.  
✅ **User Registration via CLI** - Create users directly from the terminal.  
✅ **Set Default User for CLI** - Set a default user ID for CLI operations.

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
php artisan fintrack:user-register
```

### **5 Set Default User for CLI Commands**

```bash
php artisan user:set
```

This sets a default user ID for all finance-related CLI commands.

---

## 🎯 Usage

### **➜ Add Income**

```bash
php artisan fintrack:add-income
```

You will be prompted to enter details like amount, category, currency, and payment status.

### **➜ Add Expense**

```bash
php artisan fintrack:add-expense
```

Log expenses like software subscriptions, office rent, etc.

### **➜ View All Incomes**

```bash
php artisan fintrack:view-incomes
```

### **➜ View All Expenses**

```bash
php artisan fintrack:view-expenses
```

### **➜ View Total Savings**

```bash
php artisan fintrack:view-savings
```

(Income - Expenses = Savings)

### **➜ Calculate Tax**

```bash
php artisan fintrack:calculate-tax --year=2025
```

This command calculates taxes based on progressive brackets and deductible expenses.

### **➜ Export Finance Data as CSV**

```bash
php artisan fintrack:export --user=1
```

(Replace `1` with your user ID, or omit it to export all users.)

---

## 🛠 Troubleshooting

🔹 **No users found?**  
Run: `php artisan fintrack:user-register` to create one.

🔹 **Database error?**  
Check your `.env` file and ensure the database is set up properly.

🔹 **Need help?**  
Run `php artisan list` to see all available commands.

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).
