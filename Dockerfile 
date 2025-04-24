# Usa imagem oficial do PHP com servidor embutido
FROM php:8.2-cli

# Copia os arquivos do seu projeto para o container
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

# Expõe a porta padrão do PHP
EXPOSE 8000

# Comando para rodar o servidor embutido
CMD ["php", "-S", "0.0.0.0:8000"]
