// Run the below command where your docker file exists with code this will build a new image for you 
docker build -t apimaker .

//To launch the container
docker run -d -p 8888:80 --name=apimaker_app apimaker
