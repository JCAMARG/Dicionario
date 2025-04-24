# Usa imagem oficial do PHP com servidor embutido
FROM php:8.2-cli

# Instala dependências do sistema e habilita a extensão mysqli
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip \
 && docker-php-ext-install mysqli

# Copia os arquivos do seu projeto para o container
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

# Expõe a porta padrão do PHP
EXPOSE 8000

# Comando para rodar o servidor embutido
CMD ["php", "-S", "0.0.0.0:8000"]
