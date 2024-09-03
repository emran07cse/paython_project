import mysql.connector
from mysql.connector import Error

class DBHandler:
    @staticmethod
    def connect_db():
        try:
            # Database connection details
            DB_HOST = "localhost"
            DB_USER = "root"
            DB_PASS = ""
            DB_NAME = "brts"

            # Establish the connection
            connection = mysql.connector.connect(
                host=DB_HOST,
                user=DB_USER,
                password=DB_PASS,
                database=DB_NAME
            )

            if connection.is_connected():
                print("Connected to MySQL database")
                return connection
        except Error as e:
            print(f"Error: {e}")
            return None

    @staticmethod
    def query(connection, table, fields='*', where='', order='', limit=10, page=1):
        try:
            cursor = connection.cursor(dictionary=True)
            where_clause = f" WHERE {where}" if where else ''
            order_clause = f" ORDER BY {order}" if order else ''
            limit_clause = f" LIMIT {(page - 1) * limit}, {limit}"

            if isinstance(fields, list):
                fields = ', '.join(fields)
            elif fields == '':
                fields = '*'

            query = f"SELECT {fields} FROM {table}{where_clause}{order_clause}{limit_clause}"
            cursor.execute(query)
            return cursor.fetchall()
        except Error as e:
            print(f"Error executing query: {e}")
            return None

    @staticmethod
    def query_with_sql(connection, sql):
        try:
            cursor = connection.cursor(dictionary=True)
            cursor.execute(sql)
            return cursor.fetchall()
        except Error as e:
            print(f"Error executing query: {e}")
            return None

    @staticmethod
    def insert(connection, table, data):
        try:
            cursor = connection.cursor()
            fields = ', '.join(data.keys())
            values = ', '.join(['%s'] * len(data))
            query = f"INSERT INTO {table} ({fields}) VALUES ({values})"
            cursor.execute(query, list(data.values()))
            connection.commit()
            return cursor.lastrowid
        except Error as e:
            print(f"Error inserting data: {e}")
            return None

    @staticmethod
    def update(connection, table, data, where):
        try:
            cursor = connection.cursor()
            set_clause = ', '.join([f"{key}=%s" for key in data.keys()])
            query = f"UPDATE {table} SET {set_clause} WHERE {where}"
            cursor.execute(query, list(data.values()))
            connection.commit()
            return cursor.rowcount
        except Error as e:
            print(f"Error updating data: {e}")
            return None

    @staticmethod
    def delete(connection, table, where):
        try:
            if not where:
                return False
            cursor = connection.cursor()
            query = f"DELETE FROM {table} WHERE {where}"
            cursor.execute(query)
            connection.commit()
            return cursor.rowcount
        except Error as e:
            print(f"Error deleting data: {e}")
            return None

    @staticmethod
    def mysql_to_array(result):
        try:
            return [row for row in result]
        except Error as e:
            print(f"Error converting MySQL result to array: {e}")
            return None

# Example usage
if __name__ == "__main__":
    db = DBHandler.connect_db()
    if db:
        # Example query
        results = DBHandler.query(db, "your_table_name", fields=['id', 'name'], where="id > 10", order="id DESC", limit=5, page=1)
        print(results)
        db.close()
