#Run the below command where your docker file exists with code this will build a new image for you

docker build -t apimaker .

#To launch the container

docker run -d -p 8888:80 --name=apimaker_app apimaker

#Using the below command the containers will be launched in interactive mode so stop them use ctrl+c

docker compose up

#If you want to run the compose in deamon mode use the below command 

docker compose up -d

#To remove the container use below command 

docker compose down 

