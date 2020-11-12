FROM node:12

WORKDIR /servidor

COPY package*.json ./

RUN npm install 
RUN npm install express
RUN npm install cors
RUN npm install aws-sdk
RUN npm install body-parser
RUN npm install uuid

COPY . .

EXPOSE 9000

CMD node ./index.js