// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'

// Vuetify
import { createVuetify } from 'vuetify'
import { VFileUpload } from 'vuetify/labs/VFileUpload'

const lightTheme = {
  dark: false,
  colors: {
    primary: '#800080', // Purple
    secondary: '#FFFFFF', // White
    accent: '#82B1FF',
    error: '#FF5252',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FFC107',
    background: '#FFFFFF',
    surface: '#FFFFFF',
  },
};

const darkTheme = {
  dark: true,
  colors: {
    primary: '#800080', // Purple
    secondary: '#1C1C1C', // Dark Grey (almost black)
    accent: '#82B1FF',
    error: '#FF5252',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FFC107',
    background: '#1C1C1C',
    surface: '#1C1C1C',
    text: '#FFFFFF', // White text
  },
};

export default createVuetify({
  components: {
    VFileUpload,
  },
  theme: {
    defaultTheme: 'lightTheme',
    themes: {
      lightTheme,
      darkTheme,
    },
  },
});
