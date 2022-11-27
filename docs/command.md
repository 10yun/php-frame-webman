


### 创建模块

```sh
php webman addons:create [addons_name]
```

### 创建模块的crud

```sh

# 无角色
php webman addons:crud --addons=test --name=test

# 区分角色
php webman addons:crud --addons=test --name=business/test
```