# main.py
from db_handler import DBHandler

def main():
    # Connect to the database
    connection = DBHandler.connect_db()
    
    if connection:
        # Fetch data using the query method
        results = DBHandler.query(connection, "l_class", 
            fields=['id', 'c_name'], 
            where="", 
            order="",
            limit=5, page=1
        )
        
        # Process the results
        if results:
            for row in results:
                print(row)
        else:
            print("No data found or an error occurred.")

        # Close the database connection
        connection.close()

if __name__ == "__main__":
    main()
