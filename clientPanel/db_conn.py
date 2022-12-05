import crypt
from mysql import connector


def get_connection():
    try:
        connection = connector.MySQLConnection(
            user='root',
            password='password',
            host='127.0.0.1',
            database='web_sites'
        )
    except Exception as error:
        print(error)
        raise error
    return connection

def create_database(username:str, password:str, db_name:str):
    conn = get_connection()
    cursor = conn.cursor()
    query = f"CREATE DATABASE IF NOT EXISTS {db_name} DEFAULT CHARACTER SET 'utf8';"
    cursor.execute(query)
    query = "CREATE USER %s@localhost IDENTIFIED BY %s;"
    cursor.execute(query, (username, password))
    query = f"GRANT ALL PRIVILEGES ON {db_name}.* TO %s@localhost;"
    cursor.execute(query, (username))
    cursor.execute('FLUSH PRIVILEGES;')
    conn.close()
    
def save_site(username:str, password:str, domain:str, db_name:str):
    ecrypt_parr = crypt.crypt(password, 'secret')
    conn = get_connection()
    cursor = conn.cursor()
    query = 'INSERT INTO (username, ecrypt_parr, domain, name_db) VALUES (%s, %s, %s, %s)'
    cursor.execute(query, (username, ecrypt_parr, domain, db_name))
    conn.close()

def exists(**kwargs):
    param = list(kwargs.keys()).pop()
    if not param: return False
    value = kwargs.get(param)
    if not value: return False
    conn = get_connection()
    cursor = conn.cursor()
    query = f'SELECT {param} FROM sites WHERE username = %s'
    
    cursor.execute(query, (value,))
    row = cursor.fetchone()

    conn.close()

    return row is not None

def exists_username(username:str) -> bool:
    return exists(username=username)

def exists_domain(domain:str) -> bool:
    return exists(domain=domain)

def exists_db_name(name_db:str) -> bool:
    return exists(name_db=name_db)
