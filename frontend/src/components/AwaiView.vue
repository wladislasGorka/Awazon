<template>
    <div class="chatbot-container">
      <!-- Image instead of icon -->
      <v-btn icon class="chatbot-icon" @click="toggleChat">
        <v-img src="/images/chat-icon.png" alt="Chat" width="50" height="50" contain></v-img>
      </v-btn>
  
      <!-- Chat Window -->
      <v-card v-if="isOpen" class="chatbot-window" ref="chatbotWindow">
        <v-card-title>Awai - Votre assistant</v-card-title>
        <v-card-text>
          <v-list>
            <v-list-item v-for="(msg, index) in messages" :key="index">
              <v-list-item-content>
                <v-list-item-subtitle v-if="msg.sender === 'bot'" class="bot-message">{{ msg.text }}</v-list-item-subtitle>
                <v-list-item-subtitle v-else class="user-message">{{ msg.text }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>
        <v-card-actions>
          <v-text-field 
            v-model="userInput" 
            label="Écrivez ici..." 
            @keyup.enter="sendMessage"
            class="chat-input"
          ></v-text-field>
          <v-btn @click="sendMessage" color="primary">Envoyer</v-btn>
        </v-card-actions>
      </v-card>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isOpen: false,
        userInput: '',
        messages: [
          { text: "Bienvenue sur Awazon ! Je suis Awa-ai, comment puis-je vous aider ?", sender: "bot" }
        ],
        responses: {
          "produit": "Vous pouvez voir nos produits en cliquant sur l'onglet 'Produits'.",
          "événements": "Les événements sont accessibles via la section 'Événements'.",
          "problème": "Pour toute aide, contactez notre support.",
          "bonjour": "Bonjour ! Comment puis-je vous aider ?",
          "aide": "Je peux vous aider à naviguer sur Awazon ! Demandez-moi ce que vous cherchez.",
          "salut": "Salut ! Comment puis-je vous aider ?",
          "merci": "De rien ! N'hésitez pas si vous avez d'autres questions.",
          "commande": "Vous pouvez passer une commande en ajoutant des produits à votre panier.",
          "livraison": "Les délais de livraison vous sont communiqués par nos commerçants."
        }
      };
    },
    methods: {
      toggleChat() {
        this.isOpen = !this.isOpen;
        if (this.isOpen) {
          document.addEventListener("click", this.closeChatOnClickOutside);
        } else {
          document.removeEventListener("click", this.closeChatOnClickOutside);
        }
      },
      closeChatOnClickOutside(event) {
        // Check if the click is outside the chatbot window
        if (this.$el && !this.$el.contains(event.target)) {
          this.isOpen = false;
          document.removeEventListener("click", this.closeChatOnClickOutside);
        }
      },
      sendMessage() {
        if (!this.userInput.trim()) return;
  
        const userText = this.userInput.toLowerCase();
        this.messages.push({ text: this.userInput, sender: "user" });
        this.userInput = '';
  
        let response = "Je ne comprends pas, pouvez-vous reformuler ?";
  
        for (const key in this.responses) {
          if (userText.includes(key)) {
            response = this.responses[key];
            break;
          }
        }
  
        setTimeout(() => {
          this.messages.push({ text: response, sender: "bot" });
        }, 500);
      }
    }
  };
  </script>
  
  
  <style scoped>
  .chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
  }
  
  .chatbot-icon {
    background-color: transparent;
    border: none;
    padding: 0;
  }
  
  .chatbot-window {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 400px; /* Increased width */
    max-height: 500px;
    overflow-y: auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    padding: 10px;
  }
  
  .bot-message {
    color: blue;
    background: #e3f2fd;
    padding: 10px;
    border-radius: 8px;
    max-width: 90%; /* Ensures better visibility */
    display: inline-block;
  }
  
  .user-message {
    color: black;
    text-align: right;
    background: #f1f1f1;
    padding: 10px;
    border-radius: 8px;
    max-width: 90%;
    display: inline-block;
  }
  
  .chat-input {
    width: 100%;
  }
  </style>
  