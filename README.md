# fun5i manager
[![License](https://img.shields.io/badge/License-Apache_2.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Create](https://org.vercel.app/github/language/yakeing/php_template)](https://org.vercel.app/)


Seiring dengan perkembangan ilmu pengetahuan, pembuatan aplikasiku mulai mengunakan penguna(users) sebagai object penelitian. Di setiap pembuatan sebuah aplikasi, aku harus memulai membangun database untuk profile penguana, dan itu cukup memakan waktu.

Di karnakan hal tersebut, aku mulai merancang program yang bertujuan untuk menyimpan profile penguna aplikasiku ke dalam satu tempat penyimpanan. Rancangan tersebut, bisa di lihat pada flow chart berikut ini:
![flow chart](https://raw.githubusercontent.com/AgungDev/fun5i_manager/master/assets/images/flow_fun5i_manager.jpg?token=GHSAT0AAAAAABWQQ3DU3CDIHEMN57VHGLKMYWN7EJQ)

### API
## [/api/users.php](http://localhost:40001/api/users.php) <br />

> sign up(String fullname, String email, String password)
> sign in(String email, String password)
```javascript
{
    "error": Bool,
    "message": String,
    "result": {
        "token": String
    }
}
```

> checkEmail(String email)
```javascript
{
    "error": Bool,
    "message": String,
    "result": {
        "fullname": String
    }
}
```

> [/register.php](http://localhost:40001/api/register.php) <br />
> POST(String email, String username, String password, int apps)
```javascript
{"error": Bool, "messages": String, "result": String}
```
