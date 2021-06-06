## API documentation


```
GET /api/users
```
Example response
```
{
  "users":[
    {
      "id":2,
      "name":"User",
      "email":"admin@admin.com",
      "email_verified_at":null,
      "is_admin":1,
      "created_at":"2021-06-04T17:06:03.000000Z",
      "updated_at":"2021-06-05T11:46:07.000000Z"
    }
  ],
  "message":"Retrieved successfully"
}
```


```
POST /api/users
```
Example request body
```
'name' => 'User Name'
'email' => 'email@email.com'
'password' => '123456'
'is_admin' => 0
```
Example response
```
{
  "user":{
    "email":"email@email.com",
    "name":"User Name",
    "updated_at":"2021-06-06T11:42:15.000000Z",
    "created_at":"2021-06-06T11:42:15.000000Z",
    "id":2
  },
  "message":"Created successfully"
}
```


```
PATCH /api/users/:id
```
Example request body
```
'name' => 'User Name'
'email' => 'email@email.com'
'password' => '123456'
'is_admin' => 0
```
Example response
```
{
  "user":{
    "id":6,
    "name":"User Name",
    "email":"email@email.com",
    "email_verified_at":null,
    "is_admin":0,
    "created_at":"2021-06-06T11:42:15.000000Z",
    "updated_at":"2021-06-06T12:04:21.000000Z"
  },
  "message":"Retrieved successfully"
}
```


```
DELETE /api/users/:id
```
Example response
```
{
  "message":"Deleted"
}
```


```
GET /api/projects
```
Example response
```
{
  "projects":[
    {
      "id":1,
      "name":"Project",
      "description":"Description",
      "user_id":"5",
      "created_at":"2021-06-06T10:34:16.000000Z",
      "updated_at":"2021-06-06T10:44:47.000000Z"
    }
  ],
  "message":"Retrieved successfully"
}
```


```
POST /api/projects
```
Example request body
```
'name' => 'Project'
'description' => 'Description'
'user_id' => 2
```
Example response
```
{
  "project":{
    "name":"Project",
    "description":"Description",
    "user_id":"2",
    "updated_at":"2021-06-06T12:16:45.000000Z",
    "created_at":"2021-06-06T12:16:45.000000Z",
    "id":3
  },
  "message":"Created successfully"
}
```


```
PATCH /api/projects/:id
```
Example request body
```
'name' => 'Project'
'description' => 'Description'
'user_id' => 2
```
Example response
```
{
  "project":{
    "id":3,
    "name":"Project",
    "description":"Description",
    "user_id":"2",
    "created_at":"2021-06-06T12:16:45.000000Z",
    "updated_at":"2021-06-06T12:16:45.000000Z"
  },
  "message":"Retrieved successfully"
}
```


```
DELETE /api/projects/:id
```
Example response
```
{
  "message":"Deleted"
}
```