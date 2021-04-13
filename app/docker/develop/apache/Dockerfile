FROM httpd:2.4

RUN apt-get update && apt-get install -y \
    wget \
    apache2-dev \
    gettext

COPY ./develop/apache/conf/httpd.conf /usr/local/apache2/conf/httpd.conf
COPY ./develop/apache/hosts/vhost.conf /usr/local/apache2/conf/vhost.template

RUN envsubst "${SITE_DOMAIN}" < /usr/local/apache2/conf/vhost.template > /usr/local/apache2/conf/vhost.conf

RUN wget -O /tmp/mod_xsendfile.tar.gz https://tn123.org/mod_xsendfile/mod_xsendfile-0.12.tar.gz \
    && mkdir /tmp/mod_xsendfile \
    && tar -xf /tmp/mod_xsendfile.tar.gz -C /tmp/mod_xsendfile --strip-components=1 \
    && cd /tmp/mod_xsendfile \
    && apxs -cia mod_xsendfile.c \
    && rm -r /tmp/*
