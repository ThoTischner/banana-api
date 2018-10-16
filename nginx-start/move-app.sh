#!/bin/bash

# copy src code to shared volume
df -h | grep -q data && rsync -av --delete /opt/app-root/src/ /data/ || echo "rsync finished"