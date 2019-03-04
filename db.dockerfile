FROM postgres:9.5-alpine
COPY dump/ /docker-entrypoint-initdb.d/