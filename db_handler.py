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
    #direct query
    @staticmethod
    def query_with_sql(connection, sql):
        try:
            cursor = connection.cursor(dictionary=True)
            cursor.execute(sql)
            return cursor.fetchall()
        except Error as e:
            print(f"Error executing query: {e}")
            return None
    #only insert query
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
    #bulk data insert into db
    @staticmethod
    def bulk_insert(connection, table, data):
        try:
            cursor = connection.cursor()
            
            # Ensure data is a list of dictionaries for bulk insert
            if not isinstance(data, list) or not all(isinstance(d, dict) for d in data):
                raise ValueError("Data should be a list of dictionaries.")

            # Prepare fields and values
            fields = ', '.join(data[0].keys())
            values = ', '.join(['%s'] * len(data[0]))

            # Prepare SQL query
            query = f"INSERT INTO {table} ({fields}) VALUES ({values})"

            # Extract all values from data
            values_list = [tuple(d.values()) for d in data]

            # Perform bulk insert using executemany
            cursor.executemany(query, values_list)
            connection.commit()
            
            print(f"{cursor.rowcount} rows inserted successfully.")
            return cursor.rowcount
        except Error as e:
            print(f"Error inserting data: {e}")
            return None
    #update query
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
    #delete query
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
    #procedure call
    @staticmethod
    def call_procedure(connection, procedure_name, args=None):
        try:
            # Create a cursor object to interact with the database
            cursor = connection.cursor()

            # Call the stored procedure
            cursor.callproc(procedure_name, args)

            # Fetch all results from the procedure
            results = []
            for result in cursor.stored_results():
                results.append(result.fetchall())

            # Commit changes if any
            connection.commit()

            # Return the fetched results
            return results
        except mysql.connector.Error as e:
            print(f"Error calling stored procedure: {e}")
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
