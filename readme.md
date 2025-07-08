# APSI CR002 PERT 13 MEMBUAT PROTOTYPE
### Membuat Ui dan membuat system blog

#### Bahasa yang diguunakan
```bash
- PHP 8.2
```
#### ENVIRONMENT
```
system docker (container)
```

## langkah langkah membuat system blog
pada folder perkuliahan ketik : 
```bash
mkdir apsi_cr002
```
setelah itu ketikan : 
```bash
mkdir pert13
```
setelah itu masuk pada folder pert 13
```bash
cd pert13
```
setelah itu ketikan : 
```bash
touch dockerfile
```
```bash
touch docker-compose.yml
```
```bash
touch httpd.vhost.conf
```
```bash
touch .env
```
```bash
mkdir src
```

```bash
strktur folder : 
# struktur folder dan penjelasan

|-- db (folder server database)
|    |-- data (folder engine database)
|    |-- conf.d (folder untuk kebutuhan tune up SERVER DB (optional) )
|    
|-- .env (setingan container docker tersebut)
|    
|-- src (Folder Project PHP)
|
|-- dockerfile (pull registry kebutuhan php)
|-- httpd.vhost.conf (seting webserver apache supaya tidak terjadi index of ketika sudah masuk PRODUCTION)
|-- docker-compose.yml (memanggil service yang kita butuhkan berbasis container)

```

#### setelah itu pada folder pert13 silahkan ketikan
```bash
docker compose up -d --build
```

#### setelah compose nya sudah selesai dan ada output seperti ini :
```bash
 ⚡ root@DESKTOP-UO99V0J  ~/apsi/cr002_live/pert12   main ±  docker compose up -d --build
WARN[0000] /root/apsi/cr002_live/pert12/docker-compose.yml: the attribute `version` is obsolete, it will be ignored, please remove it to avoid potential confusion 
[+] Building 3.9s (15/15) FINISHED                                                                                                                                                                    docker:default
 => [apache-forground internal] load build definition from dockerfile                                                                                                                                           0.0s
 => => transferring dockerfile: 1.35kB                                                                                                                                                                          0.0s
 => [apache-forground internal] load metadata for docker.io/library/php:8.2-apache                                                                                                                              2.1s
 => [apache-forground internal] load .dockerignore                                                                                                                                                              0.0s
 => => transferring context: 2B                                                                                                                                                                                 0.0s
 => [apache-forground 1/9] FROM docker.io/library/php:8.2-apache@sha256:934f83240389df24442892b6cba15b71515c0e38abd35182e0029274f036fb6a                                                                        0.0s
 => [apache-forground internal] load build context                                                                                                                                                              0.4s
 => => transferring context: 63.71MB                                                                                                                                                                            0.4s
 => CACHED [apache-forground 2/9] WORKDIR /var/www/html                                                                                                                                                         0.0s
 => CACHED [apache-forground 3/9] RUN apt-get update -y && apt-get install -y     libmariadb-dev     libpng-dev     libjpeg62-turbo-dev     libfreetype6-dev     libzip-dev     libonig-dev     libicu-dev      0.0s
 => CACHED [apache-forground 4/9] RUN docker-php-ext-configure gd --with-freetype --with-jpeg &&     docker-php-ext-install gd                                                                                  0.0s
 => CACHED [apache-forground 5/9] RUN docker-php-ext-install pdo_mysql mysqli mbstring exif zip pcntl bcmath calendar intl gettext opcache sockets                                                              0.0s
 => CACHED [apache-forground 6/9] COPY httpd.vhost.conf /etc/apache2/sites-available/000-default.conf                                                                                                           0.0s
 => CACHED [apache-forground 7/9] RUN a2enmod rewrite &&     chown -R www-data:www-data /var/www/html &&     chmod -R 755 /var/www/html                                                                         0.0s
 => CACHED [apache-forground 8/9] RUN sed -i 's/Require .*/Require all granted/' /etc/apache2/sites-available/000-default.conf                                                                                  0.0s
 => [apache-forground 9/9] COPY . /var/www/html                                                                                                                                                                 0.7s
 => [apache-forground] exporting to image                                                                                                                                                                       0.4s
 => => exporting layers                                                                                                                                                                                         0.3s
 => => writing image sha256:50180d08d20da42b1b9118fb5a245d49765d52a24a7e0406a1ee3056441d9d74                                                                                                                    0.0s
 => => naming to docker.io/library/latest                                                                                                                                                                       0.0s
 => [apache-forground] resolving provenance for metadata file                                                                                                                                                   0.0s
[+] Running 4/4
 ✔ apache-forground            Built                                                                                                                                                                            0.0s 
 ✔ Network pert12_default      Created                                                                                                                                                                          0.1s 
 ✔ Container apache-forground  Started  
```

#### setelah itu silahkan buka navicat anda 
```bash
pada navicat anda silahkan buka dan klik new connection 
```
isikan pada kolom : 
```bash
connection_name = APSI_CR002
host = 127.0.0.1
port = 12307
user Name = root
password = 123
```

#### setlah itu klik oke dan setelah itu silahkan anda di `server db` yang sudah anda connect kan silahkan anda klik kanan dan `New Database`

setelah anda klik new database tuliskan db nya : 
```bash
web_blog
```

setelah jadi database nya silahkan anda klik New Querry dan pastekan code sql nya 
```bash
/*
 Navicat Premium Data Transfer

 Source Server         : apsi_cr002
 Source Server Type    : MySQL
 Source Server Version : 100244
 Source Host           : 127.0.0.1:12306
 Source Schema         : web_blog

 Target Server Type    : MySQL
 Target Server Version : 100244
 File Encoding         : 65001

 Date: 07/07/2025 12:39:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user`(`user_id`) USING BTREE,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
```

setelah itu anda klik 
```bash
RUN 
```

#### setelah itu anda silahkan coding php nya hingga selesai 
#### setelah itu anda silahkan ke browser dan ketikan 
```bash
http://localhost:83
```
#### dan jika pada setingan docker-compose.yml pada bagian webserver nya port nya pake 80 maka pakelah 80 jika di seting tidak 80 maka pakelah setingan anda : 
```bash
  apache-forground:
    build: .
    container_name: apache-forground
    image: latest
    volumes:
      - ./src:/var/www/html
      - ./httpd.vhost.conf:/etc/apache2/sites-available/000-default.conf
    ports:
      - 83:80
```



# HAPPY CODING !!!!




