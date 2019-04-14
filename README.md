## Koperasi

## Cara mengatasi error `ONLY_FULL_GROUP_BY`
> Pada ubuntu versi 18.04
1. Mengakses data di bawah
`sudo nano /etc/mysql/my.cnf`
2. Menambahkan data pada didalam file `my.cnf`, pastikan script ditempatkan di bawah sendiri
`[mysqld]`
`sql_mode = "STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"`
3. Restart mySql
`sudo service mysql restart`

## Referensi
[https://stackoverflow.com/questions/23921117/disable-only-full-group-by](https://stackoverflow.com/questions/23921117/disable-only-full-group-by)