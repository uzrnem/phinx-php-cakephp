### Phinx database migration tools

#### Supported Adapter
> MySQL: specify the mysql adapter.

> PostgreSQL: specify the pgsql adapter.

#### Future Adapters
> SQLite: specify the sqlite adapter.

> SQL Server: specify the sqlsrv adapter.

Please raise MR for this adapter

## MYSQL
```
version: "3.7"

services:
  phinx:
    image: uzrnem/phinx:0.4
    container_name: phinx
    volumes:
      - $PWD/db:/phinx/db
    environment:
      PHINX_DB_HOST: mysqlhost
      PHINX_DB_DATABASE: mydb
      PHINX_DB_USERNAME: postgres
      PHINX_DB_PASSWORD: changeme
```


## PostgreSQL
```
version: "3.7"

services:
  phinx:
    image: uzrnem/phinx:0.4
    container_name: phinx
    volumes:
      - $PWD/db:/phinx/db
    environment:
      PHINX_DB_ADAPTER: pgsql
      PHINX_DB_HOST: postgresdb
      PHINX_DB_DATABASE: mydb
      PHINX_DB_USERNAME: postgres
      PHINX_DB_PASSWORD: changeme
      PHINX_DB_PORT: 5432
```

#### Php Code
```
./vendor/bin/phinx create CreateSubscriptionTable
./vendor/bin/phinx migrate
./vendor/bin/phinx rollback
./vendor/bin/phinx rollback -t 0
./vendor/bin/phinx status

./vendor/bin/phinx seed:create TagSeeder
./vendor/bin/phinx seed:run -v
./vendor/bin/phinx seed:run -s AccountTypeSeeder -s TransactionTypeSeeder -s TagSeeder

$this->table('posts')->drop()->save();

$table = $this->table('posts');
$table->rename('articles')
    ->update();

$table = $this->table('posts');
$table->changePrimaryKey('new_primary_key');
$table->update();

$table = $this->table('subscription');
$table->addColumn('title', 'string', ['limit' => 255, 'null' => false])
  ->addColumn('description', 'string', ['limit' => 255, 'null' => true])
  ->addColumn('amount', 'float', ['null' => false])
  ->addColumn('actual_amount', 'float', ['null' => true])
  ->addColumn('start_date', 'datetime', ['null' => true])
  ->addColumn('end_date', 'datetime', ['null' => false])
  ->addColumn('due_date', 'datetime', ['null' => true])
  ->addColumn('type', 'enum', ['values' => ['prepaid', 'postpaid'], 'default' => 'prepaid'])
  ->addColumn('status', 'boolean', ['limit' => 1, 'null' => false, 'default' => 0])
  ->addTimestamps()
  ->create();

$data = [
  [
    'body'    => 'foo',
    'created' => date('Y-m-d H:i:s'),
  ],[
    'body'    => 'bar',
    'created' => date('Y-m-d H:i:s'),
  ]
];

$posts = $this->table('posts');
$posts->insert($data)
  ->saveData();
```