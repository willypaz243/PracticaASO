from mysql import connector


def get_connection():
    connection = connector.MySQLConnection(
        user='root',
        password='password',
        host='127.0.0.1',
        database='web_sites'
    )
    return connection

def create_database():
    conn = get_connection()

def exists(**kwargs):
    param = kwargs.keys()[0]
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
