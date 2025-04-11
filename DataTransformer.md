# 📦 Data Transformer Structure

The **Data Transformer** feature is designed to convert data from external data sources into a format compatible with your Laravel application's database.

---

## 1. 🗄️ Database Setup

### 🔹 `data_sources` Table
Used to determine which data source should be used during transformation.

**Fields:**
- `name`: Name of the data source
- `url`: URL of the data source

---

### 🔹 `transformer_mappings` Table
Defines how incoming data fields should be mapped and formatted into your database structure.

**Fields:**
- `data_source_id`: Foreign key linked to `data_sources`
- `model`: Model class (e.g., `App\Models\ExampleModel`)
- `field`: Field in your database table
- `mapping`: Corresponding field from the source data
- `formatting`: Array of formatting operations using [Laravel’s Fluent String Methods](https://laravel.com/docs/12.x/strings#main-content)  
  **Example:**  
  ```json
  ["trim", "replace:example.com,mydomain.com"]
  ```
  You can chain formatting commands, such as:
  - `"trim"`
  - `"replace:example.com,mydomain.com"`
  - `"lower"`
  - `"ucfirst"`

---

### 🔹 `pk_model_fields` Table
Specifies the primary key field used when inserting data from various sources into the same table.

**Fields:**
- `model`: Model class (e.g., `App\Models\ExampleModel`)
- `primary_key`: Field used as the primary key for the model

---

## 2. ⚙️ Using the Data Transformer

Use the following method to transform incoming data:

```php
DataTransformer::transformFromSource($sourceId, $data);
```

- `$sourceId`: ID of the data source from the `data_sources` table
- `$data`: Array of data from the external source to be transformed

### 🔍 Example Endpoints
See use cases and transformation results at:

- `/api/transformer/source1`
- `/api/transformer/source2`
- `/api/transformer/source3`
- `/api/transformer/source4`

Refer to `DataTransformer.php` for more details on implementation.

---

## 3. 🧩 Inserting Formatted Data into the Database

The following classes provide different use cases for inserting formatted and transformed data into your database.

---

### ✅ `SyncDataMock.php`
**Use Case:** Inserting **related data across multiple tables** (e.g., parent-child relationships)

- You must **manually handle foreign key relationships**.
- Suitable for structured multi-table insertion logic.

**Run the command:**
```bash
php artisan app:sync-data-mock
```

---

### ✅ `SyncDataMock2.php`
**Use Case:** Inserting **data from multiple sources into a single table**

- Useful for consolidating data from different APIs or files into one model/table.

**Run the command:**
```bash
php artisan app:sync-data-mock-2
```

---
