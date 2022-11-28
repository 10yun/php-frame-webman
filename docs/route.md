



## 路由注解

| 名称            | 注解位置      | 是否可重复 | 说明                                   | 参数 |
| :-------------- | :------------ | :--------- | :------------------------------------- | :--- |
| RouteHead       | class、method | true       |
| RouteFlag       | class         | true       |
| RouteRestful    | class         | true       |                                        |
| RouteGroup      | class         | true       |                                        |
| RouteRule       | method        | true       | OPTIONS、GET、POST、PUT、PATCH、DELETE |
| RouteGet        | method        | true       | OPTIONS、GET                           |
| RoutePost       | method        | true       | OPTIONS、POST                          |
| RoutePut        | method        | true       | OPTIONS、PUT                           |
| RoutePatch      | method        | true       | OPTIONS、PATCH                         |
| RouteDelete     | method        | true       | OPTIONS、DELETE                        |
| RouteMiddleware | class、method | true       |