<?php

namespace App\Entity;

use App\Entity\Genre;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameRepository;
use App\Controller\GameCountController;
use App\Controller\GamePublishController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:collection'], 
        'openapi_definition_name' => 'Collection'],
    denormalizationContext: ['groups' => ['write:Game']],
    collectionOperations: [
        'get', 
        'post',
        'count' => [
            'method' => 'GET',
            'path' => '/games/count',
            'controller' => GameCountController::class,
            'read' => false,
            'filters' => [],
            'pagination_enabled' => false,
            'openapi_context' => [
                'summary' => 'Récupère le nombre total de jeux',
                'parameters' => [[
                    'in' => 'query',
                    'name' => 'online',
                    'schema' => [
                        'type' => 'integer',
                        'maximum' => 1,
                        'minimum' => 0]],
                        // Erreur: syntaxe ?
                        // 'description' => 'Filtre les jeux en ligne'
                    ],
                'response' => [
                    '200' => [
                        'description' => 'OK',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'integer',
                                    'example' => 3]]]]]]]],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:collection', 'read:item', 'read:Game'],
                'openapi_definition_name' => 'Detail' ]],
        'publish' => [
            'method' => 'POST',
            'path' => '/games/{id}/publish',
            'controller' => GamePublishController::class,
            'openapi_context' => [
                'summary' => 'Permet de publier un jeu',
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [] ]]]]],
        'put', 
        'patch', 
        'delete' ])]
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:collection', 'read:item'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:collection', 'read:item'])]
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups('read:collection', 'read:item')]
    private $releaseDate;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups('read:item')]
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, mappedBy="game")
     */
    #[Groups('read:item')]
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity=Type::class, mappedBy="game")
     */
    #[Groups('read:item')]
    private $types;

    /**
     * @ORM\ManyToMany(targetEntity=Editor::class, mappedBy="game")
     */
    #[Groups('read:item')]
    private $editors;

    /**
     * @ORM\ManyToMany(targetEntity=Platform::class, mappedBy="game")
     */
    #[Groups(['read:item'])]
    private $platforms;

    /**
     * @ORM\Column(type="boolean", options={"default": "0"})
     */
    #[
        Groups(['read:collection']),
        ApiProperty(openapiContext: ['type' => 'boolean', 'description' => 'En ligne'])
    ]
    private $online = false;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->editors = new ArrayCollection();
        $this->platforms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
            $genre->addGame($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->addGame($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->removeElement($type)) {
            $type->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Editor[]
     */
    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): self
    {
        if (!$this->editors->contains($editor)) {
            $this->editors[] = $editor;
            $editor->addGame($this);
        }

        return $this;
    }

    public function removeEditor(Editor $editor): self
    {
        if ($this->editors->removeElement($editor)) {
            $editor->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Platform[]
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(Platform $platform): self
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms[] = $platform;
            $platform->addGame($this);
        }

        return $this;
    }

    public function removePlatform(Platform $platform): self
    {
        if ($this->platforms->removeElement($platform)) {
            $platform->removeGame($this);
        }

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

        return $this;
    }

}
