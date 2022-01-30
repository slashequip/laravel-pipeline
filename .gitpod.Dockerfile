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
    php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir /usr/bin --filename composer && \
    php -r "unlink('composer-setup.php');"

USER gitpod
