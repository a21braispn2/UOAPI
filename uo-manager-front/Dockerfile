FROM node:20-alpine

WORKDIR /app

# Copiamos las listas de paquetes primero
COPY package*.json ./

# Instalamos dependencias limpias
RUN npm install

# Copiamos todo el código de Vue
COPY . .

# Exponemos el puerto de Vite
EXPOSE 5173

# Arrancamos el servidor de desarrollo
CMD ["npm", "run", "dev"]