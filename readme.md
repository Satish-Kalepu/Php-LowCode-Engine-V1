#Run the below command where your docker file exists with code this will build a new image for you

docker build -t apimaker .

#To launch the container use below command from the directory where your code exists.

docker run -d -p 8888:80 -v .:/var/www/html --name=apimaker_app apimaker:v1

#Using the below command the containers will be launched in interactive mode so stop them use ctrl+c

docker compose up

#If you want to run the compose in deamon mode use the below command 

docker compose up -d

#To remove the container use below command 

docker compose down 

