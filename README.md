# Projeto CEU (Central de Eventos da Uespi)
> repositório do projeto CEU

O CEU (Central de Eventos Uespi) foi um projeto iniciado na matéria de Engenharia de Software, para a construção de um sistema de eventos.


## Configuração do ambiente (Linux)

Instalação do LAMP, onde será o responsável por hospedar o site, banco de dados e o php.

  ### Instalação do servidor web Apache2
  
    sudo apt update
    sudo apt install apache2 -y
    
  Após a instação do servidor web, faça o teste http://seuip . Será esperado uma página padrão do apache.
  
  ### Instalação do banco de dados

    sudo apt install mysql-server -y
    
    
   Após instalar o mysql, execute o script de segunção do mysql:

    sudo mysql_secure_installation
    
   Para mais info, acesse: https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04-pt
    
  ### Instalação do PHP
  
    sudo apt install php libapache2-mod-php php-mysql -y
    
Caso não houver nenhum erro com as instalação acima, o LAMP estará instalado.

Para mais info do processo de instalação do LAMP, acesse: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04-pt

## Criação e recuperação do banco de dados
Para a criação e recuperação do banco de dados, basta executar o comando abaixo com o caminho do arquivo .sql na pasta ./site/_banco_de_dados

    mysql -u nome_de_usuario_bd -p ceu < ./site/_banco_de_dados/ceu.sql
    
Após a execução do comando acima, as tabelas e estrutura do banco de dados usada no projeto estará criada.

## Instalação do site
Para a instalação do site, crie uma pasta nomeado 'ceu' no seguinte diretório: /var/www/html/, executando o codigo abaixo:

    sudo mkdir /var/www/html/ceu
    
Após a criação da pasta, copie tudos os arquivos e diretorios da pasta site para o diretório criado:

    cd site/
    
    sudo cp -r ./* /var/www/html/ceu
    
Com os arquivos devidamente copiado, reinicie o servidor web apache2:

    sudo systemctl restart apache2
    
Agora só acessar o http://seuip/ceu


