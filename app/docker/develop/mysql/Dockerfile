FROM mysql:5.7

#####################################
# Set Timezone
#####################################

ARG TZ=UTC
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && chown -R mysql:root /var/lib/mysql/

COPY ./develop/mysql/conf/my.cnf /etc/mysql/conf.d/my.cnf
COPY ./develop/mysql/database/ ./data/enterpoint/

CMD ["mysqld"]

EXPOSE 3360
