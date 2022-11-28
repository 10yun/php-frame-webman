# php-frame-webman

webman framework extend

基于workerman的webman框架扩展快速开发

- workerman
- webman
- framework
- restful
- annotation

## docker搭建

```sh
# 下载镜像
docker pull /syky/php:php8112-cli-alpine

# 启动镜像
docker run  php8112

# 进入镜像
docker exec -it php8112 /bin/sh
```

## 代码搭建

```sh

# 安装webman
composer create-project workerman/webman mywebman

# 安装依赖 - console命令行
composer require webman/console
# 安装依赖 - orm模型
composer require -W webman/think-orm
# composer -W require psr/container ^1.1.1 webman/think-orm

# 安装php-webman
composer require shiyun/php-frame-webman

```

## 模块搭建

```sh
# 创建模块
php webman addons:create module1

# 创建restful的crud
php webman addons:crud --addons=module1 --name=test1
php webman addons:crud --addons=module1 --name=test2

# 创建带角色的restful的crud
php webman addons:crud --addons=module1 --name=role1/test1
php webman addons:crud --addons=module1 --name=role2/test2

```

## 启动

```sh
# 启动
php start.php start
```

## 访问测试

```sh
# get
curl http://127.0.0.1:8787/my_app1
curl http://127.0.0.1:8787/my_app1/123

# post
curl -X 


# put

# patch


```