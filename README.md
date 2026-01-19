Встановлення
```
composer install
cp .env.example .env
php artisan migrate --seed
php artisan serve
```

## API

### Продукти

| Метод  | URI                  | Описание            |
| ------ | -------------------- | ------------------- |
| GET    | `/api/products`      | Список товарів      |
| POST   | `/api/products`      | Додати товар        |
| GET    | `/api/products/{id}` | Перегляд товару     |
| PUT    | `/api/products/{id}` | Оновити товар       |
| DELETE | `/api/products/{id}` | Видалити товар      |

### Замовлення 

| Метод  | URI                | Описание            |
| ------ | ------------------ | ------------------- |
| GET    | `/api/orders`      | Список замовлень    |
| POST   | `/api/orders`      | Створити замовлення |
| GET    | `/api/orders/{id}` | Перегляд замовлення |
| PUT    | `/api/orders/{id}` | Оновити замовлення  |
| DELETE | `/api/orders/{id}` | Видалити замовлення |


#### Додати новий товар
```
{
  "name": "MacBook Pro",
  "description": "Laptop from Apple",
  "price": 2500.00,
  "stock_quantity": 10
}
```

#### Оновити товар
```
{
  "name": "MacBook Pro M3",
  "description": "Updated model",
  "price": 2700.00,
  "stock_quantity": 8
}

```

#### Створити замовлення
```
{
  "customer_name": "Dima",
  "customer_email": "dima@example.com",
  "products": [
    { "id": 1, "quantity": 2 },
    { "id": 5, "quantity": 1 }
  ]
}

```

#### Оновити замовлення
```
{
  "customer_name": "Dmytro",
  "customer_email": "dmytro@example.com",
  "products": [
    { "id": 1, "quantity": 6 }
  ]
}
```

#### Приклад помилки валідації
```
{
    "message": "The name field is required. (and 2 more errors)",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "price": [
            "The price field is required."
        ],
        "stock_quantity": [
            "The stock quantity field is required."
        ]
    }
}
```
