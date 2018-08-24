FROM openjdk:8
ADD target/docker-0.0.1-SNAPSHOT.jar docker.jar
EXPOSE 8085
ENTRYPOINT ["java", "-jar", "docker.jar"]