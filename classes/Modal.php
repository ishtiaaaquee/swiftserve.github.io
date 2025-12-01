<?php
/**
 * Modal Class
 * Manages modal windows
 */
class Modal {
    private $id;
    private $title;
    private $content;
    private $size;
    
    public function __construct($id, $title, $content, $size = 'lg') {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->size = $size;
    }
    
    public function render() {
        ?>
        <div class="modal fade" id="<?php echo htmlspecialchars($this->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-<?php echo htmlspecialchars($this->size); ?> modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo htmlspecialchars($this->title); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $this->content; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Modals Manager Class
 * Manages collection of modals
 */
class ModalsManager {
    private $modals;
    
    public function __construct() {
        $this->modals = [];
        $this->initializeDefaultModals();
    }
    
    private function initializeDefaultModals() {
        // Video Modal
        $videoContent = '<div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
        </div>';
        $this->addModal(new Modal('videoModal', 'Product Demo', $videoContent));
        
        // Portfolio Modal
        $portfolioContent = '
            <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?w=800&h=500&fit=crop" alt="Project" class="img-fluid mb-3 rounded">
            <h4>E-Commerce Platform</h4>
            <p class="text-muted">Web Development • 2024</p>
            <p>A comprehensive e-commerce solution built with modern technologies, featuring seamless checkout, inventory management, and real-time analytics.</p>
            <h6 class="mt-3">Technologies Used:</h6>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-primary">PHP</span>
                <span class="badge bg-success">JavaScript</span>
                <span class="badge bg-info">Bootstrap</span>
                <span class="badge bg-warning">MySQL</span>
            </div>
            <a href="#" class="btn btn-primary">Visit Website <i class="fas fa-external-link-alt ms-2"></i></a>
        ';
        $this->addModal(new Modal('portfolioModal1', 'Project Details', $portfolioContent));
    }
    
    public function addModal(Modal $modal) {
        $this->modals[] = $modal;
    }
    
    public function render() {
        foreach ($this->modals as $modal) {
            $modal->render();
        }
    }
}
