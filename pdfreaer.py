def extr_text(pdf_path):
    doc = fitz.open(pdf_path)
    text = ""
    for page in doc:
        text += page.get_text()  # Corrected typo here
    return text

pdf_path = r"C:\wamp64\www\paython_project\BDRAILWAY_TICKET202408282211557717.pdf"

# Verify if the file exists
if not os.path.exists(pdf_path):
    print(f"File not found: {pdf_path}")
else:
    text = extr_text(pdf_path)
    print(text)