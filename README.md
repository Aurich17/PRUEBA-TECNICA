## 🚀 **Cómo Ejecutar el Proyecto**  

### **1️⃣ Clonar el Repositorio**
```bash
git clone https://github.com/tuusuario/prueba-php-ddd.git
cd prueba-php-ddd

### **2️⃣ Levantar los Contenedores con Docker**
```terminal
#INICIA CONTENEDORES
docker-compose up --build
Esto iniciará:
✅ Un servidor PHP escuchando en http://localhost:8000
✅ Una base de datos MySQL en localhost:3307

#DETIENE CONTENEDORES
docker-compose down

🧪 Ejecutar Pruebas 
vendor/bin/phpunit --testdox   
