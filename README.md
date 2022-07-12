# fun5i manager
[![License](https://img.shields.io/badge/License-Apache_2.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Create](https://org.vercel.app/github/language/yakeing/php_template)](https://org.vercel.app/)


welcome to my service apps
![flow chart](https://raw.githubusercontent.com/AgungDev/fun5i_manager/master/assets/images/flow_fun5i_manager.jpg?token=GHSAT0AAAAAABWQQ3DU3CDIHEMN57VHGLKMYWN7EJQ)

### API
> [/login.php](http://localhost:40001/api/login.php) <br />
> POST(String username, String password)
```javascript
{"error": Bool, "messages": String, "result": String}
```

> [/register.php](http://localhost:40001/api/register.php) <br />
> POST(String email, String username, String password, int apps)
```javascript
{"error": Bool, "messages": String, "result": String}
```
