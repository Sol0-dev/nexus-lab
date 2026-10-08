FROM mysql:8.0

ENV MYSQL_ROOT_PASSWORD=root_nexus_2026
ENV MYSQL_DATABASE=nexus_portal
ENV MYSQL_USER=nexus_app
ENV MYSQL_PASSWORD=S3cur3P@ssw0rd!

COPY init.sql /docker-entrypoint-initdb.d/01-init.sql