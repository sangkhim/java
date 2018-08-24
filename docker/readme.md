### Docker Tutorial

Check Docker version

    docker -v
    
Run maven

    mvn clean install

Create Dockerfile

    FROM openjdk:8
    ADD target/docker-0.0.1-SNAPSHOT.jar docker.jar
    EXPOSE 8085
    ENTRYPOINT ["java", "-jar", "docker.jar"]

Build Docker    
    
    docker build -f Dockerfile -t my-first-docker-image .
    
Check Docker image list

    docker images

Run Docker image

    docker run -p 8085:8085 my-first-docker-image (machine-port:docker-port)
    
Push Docker image to the cloud repo

    docker login
    docker tag my-first-docker-image sangkhim/my-first-docker-image
    docker push sangkhim/my-first-docker-image
    
List Docker containers

    docker container ls
    
Stop Docker container 

    docker stop d1a1897a99c3