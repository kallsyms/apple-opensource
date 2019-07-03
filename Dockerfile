FROM ubuntu:18.04

RUN apt-get update && apt-get install -y git python3 python3-requests python3-bs4 wget git

ENTRYPOINT ["./update.py"]
