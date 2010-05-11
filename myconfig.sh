#!/bin/sh

./configure \
	--enable-maintainer-zts \
	--enable-inline-optimization \
	--enable-fastcgi \
	--enable-fpm \
	--with-mcrypt \
	--with-zlib \
	--enable-mbstring \
	--disable-pdo \
	--with-mysql \
	--with-mysqli=mysqlnd \
	--with-pgsql \
	--with-curl \
	--disable-debug \
	--enable-pic \
	--disable-rpath \
	--with-bz2 \
	--with-xml \
	--with-zlib \
	--enable-sockets \
	--enable-sysvsem \
	--enable-sysvshm \
	--enable-pcntl \
	--enable-mbregex \
	--with-mhash \
	--enable-xslt \
	--enable-zip \
	--with-pcre-regex \
	--with-json \
	--with-apc \
	--enable-memcached \
	--with-uuid \

	#--with-yajl \
	#--with-v8 \
	#--with-units
