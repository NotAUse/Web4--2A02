from flask import Flask, render_template, request, jsonify
import openai

# Remplace par ta clé API OpenAI
openai.api_key = 'ton_clef_API_openai'

app = Flask(__name__)

# Route principale pour afficher le formulaire HTML
@app.route('/')
def index():
    return render_template('index.html')

# Route pour générer l'histoire
@app.route('/generate-story', methods=['POST'])
def generate_story():
    title = request.form.get('title')

    if not title:
        return jsonify({'error': 'Titre manquant'})

    try:
        # Appel à l'API OpenAI pour générer l'histoire
        response = openai.Completion.create(
            model="text-davinci-003",
            prompt=f"Écris une histoire avec ce titre : {title}.",
            max_tokens=300
        )
        
        # Récupérer la réponse générée par GPT-3
        story = response.choices[0].text.strip()
        
        return jsonify({'story': story})

    except Exception as e:
        return jsonify({'error': f"Erreur : {str(e)}"})

if __name__ == '__main__':
    app.run(debug=True)

