# PWL Webservice

Deployed URL: https://pwl-webservice-portofolio.herokuapp.com

## API Contract
### Projects
**GET /api/projects**
----
  Returns all projects in the system.
* **URL Params**  
  None
* **Request Body**  
  None  
* **Headers**  
  Content-Type: application/json  
* **Success Response:**  
  * **Code:** 200  
  **Content:**  
    ```
    {
        "data": {
            "projects": [
                <project>
                <project>
                ...
            ]
        }
    }
    ```

** POST /api/projects**
----
    Create an project to the system.
* **URL Params**  
  None
* **Request Body**  
  ```
    {
        title: str
        description: str
    }
  ```
* **Headers**  
  Content-Type: application/json
* **Success Response:**  
  **Content:**  
    ```
    {
        message: str
    }
    ```
