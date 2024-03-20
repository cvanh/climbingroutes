## climbing routes
this project tries to index all the climbing routes and their reviews

## db schema
```mermaid
erDiagram
    AREA {
        int id pk
        int parent_id 
        int author fk 
        string name
        string rock_type
        string location
        string description
    }
    COMMENT {

    }
    MEDIA {
        int id
        int area_id fk
        string type
        string media_url
        string title
        string description
    } 
    USER {
        int id pk
        int area_id
        string name 
    }
    ROUTE {
        int id pk
        int area_id fk
        string name
        string description
        string grade
        string type
        string length
        string equipment
    }

    USER||--o{AREA : "owns"
    AREA||--o{MEDIA : "has"
    AREA||--o{COMMENT : "has"
    AREA||--o{ROUTE : "has"
```



## running 
have docker instaled and then run `make up`. You may need to run migrations, you can do that with `make sf c=doctrine:migrations:migrate`


if you wish to stop run `make down`
if you wish to see the logs run `make logs`
if you want something else run `make help` or cry