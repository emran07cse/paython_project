import fitz  # type: ignore # PyMuPDF
import os
from docx import Document  # type: ignore # python-docx

def extract_text(pdf_path):
    # Open the PDF file
    doc = fitz.open(pdf_path)
    text = ""

    # Loop through each page and extract text
    for page in doc:
        text += page.get_text()
    doc.close()  # Close the PDF file after reading
    return text

def write_to_word(text, word_path):
    # Create a new Word Document
    doc = Document()
    
    # Add text to the Word document
    doc.add_paragraph(text)
    
    # Save the Word document
    doc.save(word_path)

pdf_path = r"C:\wamp64\www\paython_project\paython_project\cv.pdf"
word_path = r"C:\wamp64\www\paython_project\paython_project\extracted_text.docx"

# Verify if the file exists
if not os.path.exists(pdf_path):
    print(f"File not found: {pdf_path}")
else:
    # Extract text from PDF
    text = extract_text(pdf_path)
    
    # Write extracted text to Word document
    write_to_word(text, word_path)
    print(f"Text extracted and saved to {word_path}")
