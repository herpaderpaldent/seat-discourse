# herpaderpaldent/seat-discourse/docs

This dockerfile is one of many out there to get `mkdocs` up and running, quickly.

Build with: `docker build -t herpaderpaldent/seat-discourse .`.  
Run with: `docker run -d --rm -p 8000:8000 --name docs -v ${PWD}:/docs herpaderpaldent/seat-discourse` from the projects root.
