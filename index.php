<?php
class AvlNode {
private $value;
private $parent;
private $leftChild;
private $rightChild;

public function __construct($value) {
$this->value = $value;
$this->parent = null;
$this->leftChild = null;
$this->rightChild = null;
}

// Методы доступа к значениям
public function getValue() {
return $this->value;
}

public function setParent(AvlNode $parent) {
$this->parent = $parent;
}

public function getParent() {
return $this->parent;
}

public function setLeftChild(AvlNode $child) {
$this->leftChild = $child;
}

public function getLeftChild() {
return $this->leftChild;
}

public function setRightChild(AvlNode $child) {
$this->rightChild = $child;
}

public function getRightChild() {
return $this->rightChild;
}
}
class AvlTree {
public $root;

public function __construct() {
$this->root = null;
}

// Метод для добавления нового узла
public function add($value) {
if ($this->root === null) {
$newNode = new AvlNode($value);
$this->root = $newNode;
return true;
} else {
$currentNode = $this->root;
while ($currentNode !== null) {
if ($value == $currentNode->getValue()) {
return false; // Узел уже существует
} elseif ($value < $currentNode->getValue()) {
if ($currentNode->getLeftChild() === null) {
$newNode = new AvlNode($value);
$currentNode->setLeftChild($newNode);
$newNode->setParent($currentNode);
break;
} else {
$currentNode = $currentNode->getLeftChild();
}
} else {
if ($currentNode->getRightChild() === null) {
$newNode = new AvlNode($value);
$currentNode->setRightChild($newNode);
$newNode->setParent($currentNode);
break;
} else {
$currentNode = $currentNode->getRightChild();
}
}
}

return true;
}
}

// Метод для поиска узла
public function find($value)
{
    if ($this->root === null) {
        return false;
    } else {
        $currentNode = $this->root;
        while ($currentNode !== null && $value != $currentNode->getValue()) {
            if ($value < $currentNode->getValue()) {
                $currentNode = $currentNode->getLeftChild();
            } else {
                $currentNode = $currentNode->getRightChild();
            }
        }

        return $currentNode === null ? false : true;
    }
}}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>AVL Tree</title>
</head>
<body>
<h1>AVL Tree Visualizer</h1>
<form id="form" method="post" action="">
    <input type="text" name="numbers" placeholder="Enter numbers separated by spaces" required>
    <button type="submit">Submit</button>
</form>

<?php
require_once 'avlTree.php';
require_once 'avlNode.php';

if (isset($_POST['numbers'])) {
    echo '<div>';
    $numbers = explode(' ', $_POST['numbers']);
    foreach ($numbers as $number) {
        $tree = new AvlTree();
        for ($i = 0; $i < count($numbers); $i++) {
            $result = $tree->add($numbers[$i]);
            if (!$result) {
                echo "<p style='color: red'>Number already exists.</p>";
                break;
            }
        }
        displayTree($tree->root, 0);
    }
    echo '</div>';
}

function displayTree($node, $level) {
    if ($node !== null) {
        echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level * 4).'<span class="node">'. $node->getValue().'</span><br/>';
        displayTree($node->getLeftChild(), $level + 1);
        displayTree($node->getRightChild(), $level + 1);
    }
}
?>
</body>
</html>

