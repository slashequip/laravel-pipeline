FROM gitpod/workspace-full

USER root

RUN add-apt-repository ppa:ondrej/php && \
    install-packages php8.1 \
    php8.1-dev \
    php8.1-bcmath \
    php8.1-ctype \
    php8.1-curl \
    php8.1-dom \
    php8.1-gd \
    php8.1-intl \
    php8.1-mbstring \
    php8.1-mysql \
    php8.1-pgsql \
    php8.1-sqlite3 \
    php8.1-tokenizer \
    php8.1-xml \
    php8.1-zip && \
    update-alternatives --set php /usr/bin/php8.1

USER root

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir /usr/bin --filename composer && \
    php -r "unlink('composer-setup.php');"

USER gitpod
