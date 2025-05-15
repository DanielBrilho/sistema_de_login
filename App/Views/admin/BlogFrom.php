<?php
?>

<link rel="stylesheet" href="/public/css/Admin/AdminBlogForm.css">

<!-- EditorJS CSS e JS -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-paragraph-with-alignment@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-header-with-alignment@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-text-color-plugin@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-table@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-audio-player"></script>

<body>
  <main class="blog-creation-wrapper">
    <div class="blog-form-container">
      <h1>Criar Nova Postagem</h1>

      <form action="/blog" method="POST" id="blogForm">

        <div class="form-group">
          <label for="title">Título</label>
          <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
          <label for="author">Autor</label>
          <input type="text" id="author" name="author">
        </div>

        <div class="form-group">
          <label for="description">Descrição</label>
          <textarea id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label for="category">Categoria</label>
          <input type="text" id="category" name="category">
        </div>

        <div class="form-group">
          <label for="editor-container">Conteúdo</label>
          <div id="editor-container"></div>
          <input type="hidden" name="body_editorjs_custom" id="editorjs-content">
        </div>

        <div class="form-group">
          <label for="tags">Tags (separadas por vírgula)</label>
          <input type="text" id="tags" name="tags">
        </div>

        

        <div class="form-actions">
          <button type="submit" class="btn-primary">Publicar</button>
        </div>

      </form>
    </div>
  </main>

  <script>
    const AudioPlayer = window.audioPlayer;

    const editor = new EditorJS({
      holder: 'editor-container',
      tools: {
        image: SimpleImage,
        paragraph: {
          class: window.Paragraph,
          inlineToolbar: ['bold', 'italic', 'link', 'Color', 'Marker'],
          config: {
            preserveBlank: true,
            alignment: true,
          }
        },
        header: {
          class: window.Header,
          inlineToolbar: true,
          config: {
            levels: [2, 3, 4, 5],
            defaultLevel: 3,
            alignment: true,
          }
        },
        list: {
          class: window.List,
          inlineToolbar: true,
          shortcut: 'CMD+SHIFT+L',
          config: {
            defaultStyle: 'unordered'
          }
        },
        checklist: {
          class: window.Checklist,
          inlineToolbar: true,
          shortcut: 'CMD+SHIFT+C'
        },
        table: {
          class: window.Table,
          inlineToolbar: true,
          config: {
            rows: 2,
            cols: 3,
            maxRows: 5,
            maxCols: 5
          }
        },
        Color: {
          class: window.ColorPlugin,
          config: {
            colorCollections: [
              '#EC7878', '#9C27B0', '#673AB7', '#3F51B5', '#0070FF',
              '#03A9F4', '#00BCD4', '#4CAF50', '#8BC34A', '#CDDC39', '#FFF'
            ],
            defaultColor: '#FF1300',
            type: 'text',
            customPicker: true
          }
        },
        embed: {
          class: window.Embed,
          config: {
            services: {
              youtube: true,
              vimeo: true,
              codepen: true,
              instagram: true,
              twitter: true
            }
          }
        },
        warning: {
          class: window.Warning,
          inlineToolbar: true,
          config: {
            titlePlaceholder: 'Aviso',
            messagePlaceholder: 'Mensagem importante…',
          },
        },
        Marker: {
          class: Marker,
        }
      },
      autofocus: true,
      placeholder: 'Comece a escrever seu conteúdo aqui...'
    });

    // Ao enviar o formulário, serializa o conteúdo do EditorJS
    document.getElementById('blogForm').addEventListener('submit', function (event) {
      event.preventDefault();

      editor.save().then((outputData) => {
        document.getElementById('editorjs-content').value = JSON.stringify(outputData);
        this.submit();
      }).catch((error) => {
        console.error('Erro ao salvar o conteúdo do editor:', error);
      });
    });
  </script>
</body>
