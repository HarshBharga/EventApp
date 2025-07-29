

# Event Management App

---

##  Back-end Setup (Laravel)

###  Requirements

- PHP `^8.4`
- MySQL `^8.0`

###  Steps

1. **Clone the repository**  
  

2. **Go to project directory**

   ```bash
   cd even-backend
   ```

3. **Install dependencies**

   ```bash
   composer install
   ```

4. **Configure `.env` file**
   Update database credentials:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eventapp
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations and seed data**

   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Start Laravel server**

   ```bash
   php artisan serve
   ```

   Open: [http://127.0.0.1:8000](http://127.0.0.1:8000)

7. **Admin Login**

   * Email: `admin@admin.com`
   * Password: `Admin@123`

---

##  Front-end Setup (Next.js)

###  Requirements

* Node.js `v22.14.0`
* npm `v11.3.0`

###  Steps

1. **Navigate to frontend directory**

   ```bash
   cd react-events-ui
   ```

2. **Install dependencies**

   ```bash
   npm install
   ```

3. **Set environment variables**
   Create `.env.local` file and add:

   ```env
   NEXT_PUBLIC_API_URL=http://localhost:8000/api
   ```

4. **Run dev server**

   ```bash
   npm run dev
   ```

   Open: [http://localhost:3000](http://localhost:3000)



