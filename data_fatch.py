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

        #insert query for data insert
        # Define the data to be inserted
        data = {
            'id': 1,            # Example value for 'id'
            'name': 'John Doe', # Example value for 'name'
            'email': 'john@example.com'  # Example value for 'email'
        }
        
        # Insert data using the insert method
        insert_id = DBHandler.insert(connection, "l_class", data)
        
        if insert_id:
            print(f"Data inserted successfully. Insert ID: {insert_id}")
        else:
            print("Failed to insert data.")



        #bulk data insert into database
        # Define the data to be inserted (a list of dictionaries)
        data = [
            {'id': 1, 'name': 'John Doe', 'email': 'john@example.com'},
            {'id': 2, 'name': 'Jane Smith', 'email': 'jane@example.com'},
            {'id': 3, 'name': 'Alice Johnson', 'email': 'alice@example.com'},
            # Add more rows as needed
        ]
        
        # Perform bulk insert using the bulk_insert method
        rows_inserted = DBHandler.bulk_insert(connection, "l_class", data)
        
        if rows_inserted:
            print(f"{rows_inserted} rows inserted successfully.")
        else:
            print("Failed to insert data.")

             # Define the data to be updated
        data_to_update = {'email': 'newjohn@example.com'}
        where_clause = "id = 1"  # Update the user with ID 1
        
        # Perform the update
        rows_updated = DBHandler.update(connection, "l_class", data_to_update, where_clause)
        
        if rows_updated:
            print(f"{rows_updated} rows updated successfully.")
        else:
            print("No rows were updated.")

        # Define the name of the stored procedure and its arguments
        procedure_name = 'your_procedure_name'
        procedure_args = (1, 'John Doe')  # Example arguments, replace with actual values

        # Call the stored procedure
        results = DBHandler.call_procedure(connection, procedure_name, procedure_args)
        
        if results:
            print("Stored procedure executed successfully. Results:")
            for result in results:
                print(result)
        else:
            print("Failed to execute stored procedure.")


        # Close the database connection
        connection.close()



    # query execution with transaction for secure query excution add
    # if connection:
    #     try:
    #         # Start a transaction
    #         DBHandler.start_transaction(connection)
            
    #         # Define the data to be inserted (a list of dictionaries)
    #         data_to_insert = [
    #             {'id': 1, 'name': 'John Doe', 'email': 'john@example.com'},
    #             {'id': 2, 'name': 'Jane Smith', 'email': 'jane@example.com'},
    #             {'id': 3, 'name': 'Alice Johnson', 'email': 'alice@example.com'},
    #         ]
            
    #         # Perform bulk insert
    #         rows_inserted = DBHandler.bulk_insert(connection, "users", data_to_insert)
            
    #         if rows_inserted:
    #             print(f"{rows_inserted} rows inserted successfully.")
    #         else:
    #             print("Failed to insert data.")
            
    #         # Define the data to be updated
    #         data_to_update = {'email': 'newjohn@example.com'}
    #         where_clause = "id = 1"  # Update the user with ID 1
            
    #         # Perform the update
    #         rows_updated = DBHandler.update(connection, "users", data_to_update, where_clause)
            
    #         if rows_updated:
    #             print(f"{rows_updated} rows updated successfully.")
    #         else:
    #             print("No rows were updated.")
            
    #         # Commit the transaction
    #         DBHandler.commit_transaction(connection)
    #     except Exception as e:
    #         # Rollback the transaction in case of an error
    #         DBHandler.rollback_transaction(connection)
    #         print(f"Transaction failed: {e}")
    #     finally:
    #         # Close the database connection
    #         connection.close()


if __name__ == "__main__":
    main()
